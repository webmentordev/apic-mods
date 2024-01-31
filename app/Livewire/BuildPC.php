<?php

namespace App\Livewire;

use App\Models\Memory;
use App\Models\Socket;
use Livewire\Component;
use App\Models\Processor;
use App\Models\Motherboard;
use App\Models\Nvme;
use App\Models\Ssd;

class BuildPC extends Component
{

    public $items = [], $errors = [], $total_price = 0;

    public $processor, 
    $motherboard, 
    $ram, 
    $nvme,
    $ssd,
    $case, $cooler;

    public $sockets, $memories, $motherboards;


    public function rules(){
        return [
            "processor" => 'required',
            "motherboard" => 'required',
            "ram" => 'required',
            "nvme" => 'required',
            "ssd" => 'required',
            "case" => 'required',
            "cooler" => 'required'
        ];
    }

    public function render()
    {
        return view('livewire.build-p-c', [
            'processors' => Processor::latest()->with(['socket'])->get(),
            'nvmes' => Nvme::latest()->get(),
            'ssds' => Ssd::latest()->get(),
        ]);
    }

    public function updatedprocessor(){
        $processor = Processor::where('name', $this->processor)->first();
        $this->sockets = Socket::where('id', $processor->socket_id)->first();
        $this->items['processor'] = [
            'name' => $processor->name,
            'price' => $processor->price,
            'socket' => $processor->socket_id,
            'image' => config('app.url').'/storage/'.$processor->image
        ];
        $this->calculator();
    }

    public function updatedmotherboard(){
        $motherboard = Motherboard::where('name', $this->motherboard)->first();
        $this->memories = Memory::where('memory_type_id', $motherboard->memory_type_id)->get();
        $this->items['motherboard'] = [
            'name' => $motherboard->name,
            'price' => $motherboard->price,
            'socket' => $motherboard->socket_id,
            'type' => $motherboard->memory_type_id,
            'image' => config('app.url').'/storage/'.$motherboard->image
        ];
        $this->calculator();
    }

    public function updatedram(){
        $ram = Memory::where('name', $this->ram)->first();
        $this->items['ram'] = [
            'name' => $ram->name,
            'price' => $ram->price,
            'type' => $ram->memory_type_id,
            'image' => config('app.url').'/storage/'.$ram->image
        ];
        $this->calculator();
    }

    public function updatedssd(){
        $ssd = Ssd::where('name', $this->ssd)->first();
        $this->items['ssd'] = [
            'name' => $ssd->name,
            'price' => $ssd->price,
            'image' => config('app.url').'/storage/'.$ssd->image
        ];
        $this->calculator();
    }

    public function updatednvme(){
        $nvme = Nvme::where('name', $this->nvme)->first();
        $this->items['nvme'] = [
            'name' => $nvme->name,
            'price' => $nvme->price,
            'image' => config('app.url').'/storage/'.$nvme->image
        ];
        $this->calculator();
    }

    public function calculator(){
        $price = 0;
        foreach($this->items as $key => $item){
            $price += $item['price'];
        }
        $this->total_price = $price;
    }


    public function compatibility(){
        if($this->items['motherboard']['socket'] != $this->items['processor']['socket']){
            array_push($this->errors, "Motherboard and Processor are not compatible");
        }

        if($this->items['motherboard']['type'] != $this->items['processor']['type']){
            array_push($this->errors, "Motherboard and RAM(s) are not compatible");
        }
    }
}