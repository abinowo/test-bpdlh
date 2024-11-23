<?php

namespace App\Http\Resources;

use App\Models\OrderDetail;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductByDayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = $request->date ?? null;
        $fullDate = "{$date} {$this->time}";
        // dump($fullDate);
        $totalOrder = OrderDetail::where('product_id', $this->id)
            ->join('orders', 'orders.id', '=', 'orders_detail.order_id')
            ->where('orders.date_start', 'like', "%{$fullDate}%")
            ->where('orders.date_end', 'like', "%{$date}%")
            ->where('orders.status_payment', 'settlement')
            ->count('orders_detail.id');
        $meta = $this->meta ? json_decode($this->meta) : null;
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'image' => $this->image ?? 'https://placehold.co/400',
            'duration' => $this->duration,
            'level' => $this->level,
            'price' => $this->price,
            'min_person' => $this->min_person,
            'max_person' => $this->max_person,
            'equipment' => $this->equipment,
            'prerequisite' => $this->prerequisite,
            'description' => $meta && isset($meta->description) ? $meta->description : null,
            'time' => $this->time,
            'number_spot_left' => $this->max_person - $totalOrder,
            'instructor' => [
                'id' => $this->instructor->id ?? '-',
                'name' => $this->instructor->name ?? '-',
                'address' => $this->instructor->address ?? '-',
                'phone' => $this->instructor->phone ?? '-',
            ],
        ];
    }

    public static function paginate(LengthAwarePaginator $paginate)
    {
        return [
            'data' => self::collection($paginate->getCollection()),
            'pagination' => [
                'current_page' => $paginate->currentPage(),
                'per_page' => $paginate->perPage(),
                'total' => $paginate->total(),
                'total_pages' => $paginate->lastPage(),
            ],
        ];
    }
}