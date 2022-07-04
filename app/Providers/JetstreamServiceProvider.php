<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Fortify\Fortify;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {

                $rol = $user->getRoleNames()->first();
                $id_user=$user->id;

                $organizacion_origen=$user->organizacion_origen;

                $estatus = User::join('inscriptions','inscriptions.user_id','users.id')
                ->join('course_details','course_details.id','inscriptions.course_detail_id')
                ->join('periods','periods.id','course_details.period_id')
                ->select('inscriptions.estatus_participante')
                ->where('inscriptions.user_id','=',$id_user)
                ->where('inscriptions.estatus_participante','=','Instructor')
                ->where('periods.estado','=',1)
                ->first();
                // dd($estatus);
                if($rol!=='Super admin' and $rol!=='Administrador'){
                    if($request->rol=='Instructor' and $estatus==null){
                        if($organizacion_origen=='Tecnologico de oaxaca' and $rol == 'Instructor'){
                            $user->syncRoles('Participante');
                        }
                        if($organizacion_origen!=='Tecnologico de oaxaca' and $rol == 'Participante'){
                            $user->syncRoles('Instructor');
                            return $user;
                        }
                        if($organizacion_origen!=='Tecnologico de oaxaca'){
                            return $user;
                        }
                    }
                    if($request->rol=='Participante'){
                        if($rol !== 'Participante'){
                            $user->syncRoles($request->rol);
                            return $user;
                        }
                        else{
                            return $user;
                        }
                    }
                    if($request->rol=='Instructor' and $estatus!==null and $rol == 'Participante'){
                        $user->syncRoles($request->rol);
                        return $user;
                    }
                    if($request->rol=='Instructor' and $rol == 'Instructor'){
                        return $user;
                    }
                }
                if($rol=='Super admin' or $rol=='Administrador'){
                    return $user;
                }
            }

        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
