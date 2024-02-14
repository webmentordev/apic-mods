<?php

namespace App\Livewire;

use App\Models\AirCooler;
use App\Models\Cooler;
use App\Models\CustomController;
use App\Models\CustomCover;
use App\Models\CustomLoop;
use App\Models\Fan;
use App\Models\Gpu;
use App\Models\Memory;
use App\Models\Socket;
use Livewire\Component;
use App\Models\Processor;
use App\Models\Motherboard;
use App\Models\Nvme;
use App\Models\PcCase;
use App\Models\Ssd;
use App\Models\WaterCooler;

class BuildPC extends Component
{

    public $items = [], $errors = [], $total_price = 0, $ram_count = 1, $nvme_count = 1, $ssd_count = 1, $coolertype = "";

    public $processor, 
    $motherboard, 
    $ram, 
    $nvme,
    $ssd,
    $gpu,
    $case, $cooler;

    public $customtype, $customcover, $coolerfans, $coolercont, $extracool;

    public $sockets, $memories, $motherboards, $cases;

    public $cooler_types = [
        "Air Cooler",
        "Water Cooler",
        "Custom PC Cooler"
    ];


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
            'processors' => Processor::latest()->where('is_active', true)->with(['socket'])->get(),
            'nvmes' => Nvme::latest()->where('is_active', true)->get(),
            'ssds' => Ssd::latest()->where('is_active', true)->get(),
            'gpus' => Gpu::latest()->where('is_active', true)->get(),
            'coolers' => Cooler::orWhere('type', $this->coolertype)->latest()->get(),
            'fan' => Fan::latest()->where('is_active', true)->first(),
            'loops' => CustomLoop::where('is_active', true)->get(),
            'covers' => CustomCover::where('is_active', true)->get(),
            'controllers' => CustomController::where('is_active', true)->get()
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
        $this->cases = PcCase::get();
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

    public function updatedgpu(){
        $gpu = Gpu::where('name', $this->gpu)->first();
        $this->items['gpu'] = [
            'name' => $gpu->name,
            'price' => $gpu->price,
            'power' => $gpu->power,
            'image' => config('app.url').'/storage/'.$gpu->image
        ];
        $this->calculator();
    }

    public function updatedcoolertype(){
        unset($this->items['cooler']);
        unset($this->items['cover']);
        unset($this->items['controller']);
        unset($this->items['loop']);
        unset($this->items['fans']);
        unset($this->items['extra']);
    }

    public function updatedcooler(){
        $cooler = Cooler::where('name', $this->cooler)->first();
        $this->items['cooler'] = [
            'name' => $cooler->name,
            'price' => $cooler->price,
            'image' => config('app.url').'/storage/'.$cooler->image
        ];
        $this->calculator();
    }

    public function updatedcustomtype(){
        $custom = CustomLoop::where('name', $this->customtype)->first();
        if($custom){
            $this->items['loop'] = [
                'name' => $custom->name,
                'price' => $custom->price
            ];
            $this->calculator();
        }else{
            $this->customtype = null;
            $this->calculator();
            unset($this->items['loop']);
        }
    }

    public function updatedcustomcover(){
        $custom = CustomCover::where('name', $this->customcover)->first();
        $this->items['cover'] = [
            'name' => $custom->name,
            'price' => $custom->price
        ];
        $this->calculator();
    }

    public function updatedcoolercont(){
        $custom = CustomController::where('name', $this->coolercont)->first();
        $this->items['controller'] = [
            'name' => $custom->name,
            'price' => $custom->price
        ];
        $this->calculator();
    }

    public function updatedcoolerfans(){
        $fans = Fan::where('name', $this->coolerfans)->first();
        if($fans){
            $this->items['fans'] = [
                'name' => 'Water Cooler: '.$fans->name,
                'price' => $fans->price
            ];
            $this->calculator();
        }else{
            $this->calculator();
            $this->coolerfans = null;
            unset($this->items['fans']);
        }
    }

    public function updatedextracool(){
        $fans = Fan::where('name', $this->extracool)->first();
        if($fans){
            $this->items['extra'] = [
                'name' => 'Other Parts cooling: '.$fans->name,
                'price' => $fans->price
            ];
            $this->calculator();
        }else{
            $this->calculator();
            $this->extracool = null;
            unset($this->items['extra']);
        }
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
        unset($this->items['ram']);
        $this->ram_count = 1;
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

    public function removeGPU(){
        unset($this->items['gpu']);
        $this->ssd = null;
        $this->calculator();
    }

    public function removeProcessor(){
        unset($this->items['processor']);
        unset($this->items['motherboard']);
        unset($this->items['ram']);
        $this->motherboard = null;
        $this->processor = null;
        $this->calculator();
    }

    public function removeSSD($number){
        unset($this->items['ssds'][$number]);
        $this->items['ssds'] = array_values($this->items['ssds']);
        $this->ssd_count = $this->ssd_count - 1;
        $this->calculator();
    }

    public function removeCooler(){
        $this->coolertype = "";
        unset($this->items['cooler']);
        unset($this->items['cover']);
        unset($this->items['controller']);
        unset($this->items['loop']);
        unset($this->items['extra']);
        unset($this->items['fans']);
        $this->calculator();
    }

    public function removeSelectedCooler(){
        unset($this->items['cooler']);
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