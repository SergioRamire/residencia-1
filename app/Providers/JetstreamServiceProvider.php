<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Period;
use App\Models\CourseDetail;
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
                $estado_usuario =$user->estatus;
                $id_user=$user->id;
                $fecha_actual=date('Y/m/d');

                $organizacion_origen=$user->organizacion_origen;
                $consultar_fecha_limite_para_calificar=Period::where('periods.fecha_inicio','<=',$fecha_actual)
                                                        ->where('periods.fecha_limite_para_calificar','>=',$fecha_actual)
                                                        ->select('periods.id')
                                                        ->get();
                $arreglo_ids_periodos=[];
                foreach($consultar_fecha_limite_para_calificar as $limite){
                    array_push($arreglo_ids_periodos,$limite->id);
                }

                $consultar_usuario_instructor=User::join('inscriptions','inscriptions.user_id','users.id')
                            ->join('course_details','course_details.id','inscriptions.course_detail_id')
                            ->join('periods','periods.id','course_details.period_id')
                            ->select('users.id')
                            ->where('inscriptions.user_id','=',$id_user)
                            ->where('inscriptions.estatus_participante','=','Instructor')
                            ->whereIn('periods.id',$arreglo_ids_periodos)
                            ->get();

                $consultar_usuario_participante=User::join('inscriptions','inscriptions.user_id','users.id')
                            ->join('course_details','course_details.id','inscriptions.course_detail_id')
                            ->join('periods','periods.id','course_details.period_id')
                            ->select('users.id')
                            ->where('inscriptions.user_id','=',$id_user)
                            ->where('inscriptions.estatus_participante','=','Participante')
                            ->whereIn('periods.id',$arreglo_ids_periodos)
                            ->get();
                $instructor_actualmente=count($consultar_usuario_instructor);
                $particiánte_actualmente=count($consultar_usuario_participante);
                if($estado_usuario==1){
                    if($rol!=='Super admin' and $rol!=='Administrador' and $rol!=='Coordinador' and $rol!=='Jefa de departamento'){ //a los usuarios que tienen estos roles no se les cambia el rol nunca, ni con los valores del rb
                        if($request->rol=='Instructor' and $instructor_actualmente==0){ //si seleccionó el rb instrcutor y no es intructor en el periodo activo
                            if($organizacion_origen=='Tecnológico de oaxaca' and $rol == 'Instructor'){ //Si es del Tec y su rol es intructor
                                // $user->syncRoles('Participante'); //cambiale el rol a participante(por si se haya quedado con el rol Instructor)
                                return false;
                            }
                            if($organizacion_origen!=='Tecnológico de oaxaca' and $rol == 'Participante'){ //si no es del tec y por equivocación lo hayan guardado con el rol participante
                                $user->syncRoles('Instructor'); // entrará como instructor siempre aunque no sea de un periodo activo
                                return $user; //entra
                            }
                        }
                        if($request->rol=='Participante' and $rol == 'Participante')
                            return $user;
                        if($request->rol=='Participante' and $organizacion_origen=='Tecnológico de oaxaca'){ //si selecciono el rb participante
                            $user->syncRoles($request->rol); //se le asigna ese rol
                            return $user; //entra
                        }
                        if($request->rol=='Participante' and $organizacion_origen!=='Tecnológico de oaxaca')
                            return false;
                        if($request->rol=='Instructor' and $instructor_actualmente!==0){
                            $user->syncRoles($request->rol); //se le cambia el rol
                            return $user; //entra
                        }
                        if($request->rol=='Participante' and $particiánte_actualmente!==0){
                            $user->syncRoles($request->rol); //se le cambia el rol
                            return $user; //entra
                        }
                    }
                    return $user; //entra al sistema si es admin, super admin, o el nuevo rol que no se si ya lo agregaron "coordinador"
                }
                return false;

            }
            return false;

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
