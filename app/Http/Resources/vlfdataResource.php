<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class vlfdataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title, 
            'SKU' => $this->SKU, 
            'parent_SKU' => $this->parent_SKU, 
            'parent_id' => $this->parent_id, 
            'vehicle_type' => $this->vehicle_type, 
            'vehicle_make' => $this->vehicle_make, 
            'vehicle_model' => $this->vehicle_model, 
            'variant' => $this->variant, 
            'vlf_type' => $this->vlf_type, 
            'fuel_type' => $this->fuel_type, 
            'price' => $this->price, 
            'k_type' => $this->k_type, 
            'economy_gain_bhp' => $this->economy_gain_bhp, 
            'economy_gain_nm' => $this->economy_gain_nm, 
            'fuel_saving' => $this->fuel_saving, 
            'original_bhp' => $this->original_bhp, 
            'original_torque' => $this->original_torque, 
            'power_bhp' => $this->power_bhp, 
            'torque_nm' => $this->torque_nm, 
            'vswitch_support' => $this->vswitch_support, 
            'perm_type' => $this->perm_type, 
            'perm_make' => $this->perm_make, 
            'perm_model' => $this->perm_model
        ];

        // return parent::toArray($request);
    }
}
