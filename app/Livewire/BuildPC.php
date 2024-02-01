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

    public $items = [], $errors = [], $total_price = 0, $ram_count = 1, $nvme_count = 1, $ssd_count = 1;

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

    public function addNVME(){
        $this->nvme_count++;
    }

    public function addRAM(){
        $this->ram_count++;
    }

    public function addSSD(){
        $this->ssd_count++;
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

    public function addNvmeToArray($number, $nvme){
        $nvme = Nvme::where('name', $nvme)->first();
        $this->items['nvmes'][$number] = [
            'name' => $nvme->name,
            'price' => $nvme->price,
            'image' => config('app.url').'/storage/'.$nvme->image
        ];
        $this->calculator();
    }

    public function addSsdToArray($number, $ssd){
        $ssd = Ssd::where('name', $ssd)->first();
        $this->items['ssds'][$number] = [
            'name' => $ssd->name,
            'price' => $ssd->price,
            'image' => config('app.url').'/storage/'.$ssd->image
        ];
        $this->calculator();
    }

    public function calculator(){
        $price = 0;
        foreach($this->items as $key => $item){
            if($key == "nvmes"){
                foreach($item as $nvme){
                    $price += $nvme['price'];
                }
            }elseif($key == "ssds"){
                foreach($item as $ssd){
                    $price += $ssd['price'];
                }
            }else{
                $price += $item['price'];
            }
        }
        $this->total_price = $price;
    }


    public function removeRAM(){
        unset($this->items['rams']);
        $this->calculator();
    }

    public function removeNVMES(){
        unset($this->items['nvmes']);
        $this->nvme_count = 1;
        $this->calculator();
    }

    public function removeNVME($number){
        unset($this->items['nvmes'][$number]);
        $this->items['nvmes'] = array_values($this->items['nvmes']);
        $this->nvme_count = $this->nvme_count - 1;
        $this->calculator();
    }

    public function removeSSDS(){
        unset($this->items['ssds']);
        $this->ssd_count = 1;
        $this->calculator();
    }

    public function removeSSD($number){
        unset($this->items['ssds'][$number]);
        $this->items['ssds'] = array_values($this->items['ssds']);
        $this->ssd_count = $this->ssd_count - 1;
        $this->calculator();
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