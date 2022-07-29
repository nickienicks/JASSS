<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Carbon\Carbon;
use App\Models\Deuda;

use Illuminate\Support\Facades\DB;
use App\Models\Persona;

class SuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    
    public function handle(Login $event):void
    {
        $today1=Carbon::today();
        $prueba=DB::table('personas')->where('corte','<',$today1)->get();
        
        if(sizeof($prueba) > 0){

            foreach ($prueba as $prue) {
                $dui=DB::table('deudas')->where('persona_id',$prue->id)->where('type',true)->where('monto',30)->get();
                $cdui=count($dui);
                if($cdui == 0){
                    Deuda::create([
                        'fecha'=> $today1,  
                       'monto'=> 30,
                       'type'=>true,
                       'medida_ant'=> 0,
                       'medida_act'=> 0,
                       'persona_id' => $prue->id,
                    ]);
                }
            }
        }
    }
}
