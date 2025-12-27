<?php

namespace App\Observers;
use Auth;
use App\Models\Log;

class GlobalObserver
{
    public function created($model)
    {
        $parts = explode("\\", get_class($model));
        $model_name = end($parts);
        
        Log::create([
            'action' => 'created',
            'model' => $model_name,
            'after' => json_encode($model->getAttributes()),
            'user_id' => auth()->id() !== null ? auth()->id() : 0,
            'company_id' => isset(Auth::user()->company_id) ?? Auth::user()->company_id
        ]);
    }
    
    public function updated($model){
        $parts = explode("\\", get_class($model));
        $model_name = end($parts);
        
        
        $changes = $model->getChanges();
        
        
        if(array_key_exists("is_deleted",$changes)){
            $action_type = $changes['is_deleted'] == 1 ? "deleted" : "activated";
            
            Log::create([
                'action' => $action_type,
                'model' => $model_name,
                'before' => json_encode($model->getAttributes()),
                'after' => json_encode($changes),
                'user_id' => auth()->id(),
                'company_id' => Auth::user()->company_id
            ]);
        }else{
            Log::create([
                'action' => 'updated',
                'model' => $model_name,
                'before' => json_encode($model->getAttributes()),
                'after' => json_encode($changes),
                'user_id' => auth()->id(),
                'company_id' => Auth::user()->company_id
            ]);
        }
    }

    // Implement other methods as needed (updated, deleted, etc.)
}