<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Thesis;
use Illuminate\Database\Eloquent\Factories\Relationship;

class ThesisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /*return [
            'id' => $this->id,
            'type' => 'Theses',
            'attributes' => [
                'title' => $this->title,
                'tag' => $this->tag,
                'publisher' => $this->publisher,
                'proglang' => $this->proglang,
                'description' => $this->description,
                'image' => $this->image,
                'file_path' => $this->file_path,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];*/
        return [
            'id' => $this->id,
            'type' => 'Theses',
            'attributes' => [
                'title' => $this->title,
                'publisher' => $this->publisher,
                'proglang' => $this->proglang,
                'description' => $this->description,
                'image' => $this->image,
                'file_path' => $this->file_path,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'tag' => $this->tag,
            ],
        ];
    }
}
