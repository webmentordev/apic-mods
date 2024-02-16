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
use App\Models\Order;
use App\Models\PcCase;
use App\Models\Psu;
use App\Models\Ssd;
use App\Models\WaterCooler;

class BuildPC extends Component
{

    public $items = [], $customErrors = [], $total_price = 0, $ram_count = 1, $nvme_count = 1, $ssd_count = 1, $coolertype = "", $name, $contact, $message;

    public $processor, 
    $motherboard, 
    $ram, 
    $nvme,
    $ssd,
    $gpu,
    $psu,
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
            "case" => 'required',
            "gpu" => 'required',
            "cooler" => 'required',
            'name' => 'required|string|max:255',
            'contact' => 'required|numeric',
            'message' => 'required',
        ];
    }

    public function updated(){
        $this->validate();
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
            'controllers' => CustomController::where('is_active', true)->get(),
            'psus' => Psu::where('is_active', true)->get()
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
        $processor = Processor::where('name', $this->processor)->where('is_active', true)->first();
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
        $motherboard = Motherboard::where('name', $this->motherboard)->with(['size'])->where('is_active', true)->first();
        $this->memories = Memory::where('memory_type_id', $motherboard->memory_type_id)->where('is_active', true)->get();
        $this->cases = PcCase::get();
        $this->items['motherboard'] = [
            'name' => $motherboard->name,
            'price' => $motherboard->price,
            'socket' => $motherboard->socket_id,
            'size' => $motherboard->size->number,
            'type' => $motherboard->memory_type_id,
            'image' => config('app.url').'/storage/'.$motherboard->image
        ];
        $this->calculator();
    }

    public function updatedram(){
        $ram = Memory::where('name', $this->ram)->where('is_active', true)->first();
        $this->items['ram'] = [
            'name' => $ram->name,
            'price' => $ram->price,
            'type' => $ram->memory_type_id,
            'image' => config('app.url').'/storage/'.$ram->image
        ];
        $this->calculator();
    }

    public function updatedcase(){
        $case = PcCase::where('name', $this->case)->where('is_active', true)->with(['size'])->first();
        $this->items['case'] = [
            'name' => $case->name,
            'price' => $case->price,
            'size' => $case->size->number,
            'image' => config('app.url').'/storage/'.$case->image
        ];
        $this->calculator();
    }

    public function addNvmeToArray($number, $nvme){
        $nvme = Nvme::where('name', $nvme)->where('is_active', true)->first();
        $this->items['nvmes'][$number] = [
            'name' => $nvme->name,
            'price' => $nvme->price,
            'image' => config('app.url').'/storage/'.$nvme->image
        ];
        $this->calculator();
    }

    public function addSsdToArray($number, $ssd){
        $ssd = Ssd::where('name', $ssd)->where('is_active', true)->first();
        $this->items['ssds'][$number] = [
            'name' => $ssd->name,
            'price' => $ssd->price,
            'image' => config('app.url').'/storage/'.$ssd->image
        ];
        $this->calculator();
    }

    public function updatedgpu(){
        $gpu = Gpu::where('name', $this->gpu)->where('is_active', true)->first();
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
        $cooler = Cooler::where('name', $this->cooler)->where('is_active', true)->first();
        $this->items['cooler'] = [
            'name' => $cooler->name,
            'price' => $cooler->price,
            'image' => config('app.url').'/storage/'.$cooler->image
        ];
        $this->calculator();
    }

    public function updatedpsu(){
        $psu = Psu::where('name', $this->psu)->where('is_active', true)->first();
        $this->items['psu'] = [
            'name' => $psu->name,
            'price' => $psu->price,
            'power' => $psu->power,
            'image' => config('app.url').'/storage/'.$psu->image
        ];
        $this->calculator();
    }

    public function updatedcustomtype(){
        $custom = CustomLoop::where('name', $this->customtype)->where('is_active', true)->first();
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
        $custom = CustomCover::where('name', $this->customcover)->where('is_active', true)->first();
        $this->items['cover'] = [
            'name' => $custom->name,
            'price' => $custom->price
        ];
        $this->calculator();
    }

    public function updatedcoolercont(){
        $custom = CustomController::where('name', $this->coolercont)->where('is_active', true)->first();
        $this->items['controller'] = [
            'name' => $custom->name,
            'price' => $custom->price
        ];
        $this->calculator();
    }

    public function updatedcoolerfans(){
        $fans = Fan::where('name', $this->coolerfans)->where('is_active', true)->first();
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
        $fans = Fan::where('name', $this->extracool)->where('is_active', true)->first();
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

    public function removeCase(){
        unset($this->items['case']);
        $this->case = null;
        $this->calculator();
    }

    public function removeNVMES(){
        unset($this->items['nvmes']);
        $this->nvme_count = 1;
        $this->calculator();
    }

    public function removePSU(){
        unset($this->items['psu']);
        $this->psu = null;
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
        unset($this->items['case']);
        $this->motherboard = null;
        $this->processor = null;
        $this->case = null;
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
        $this->customErrors = [];
        if($this->items['motherboard']['socket'] != $this->items['processor']['socket']){
            array_push($this->customErrors, "Motherboard und Prozessor sind nicht kompatibel");
        }
        if($this->items['motherboard']['type'] != $this->items['ram']['type']){
            array_push($this->customErrors, "Motherboard und RAM(s) sind nicht kompatibel");
        }
        if($this->items['motherboard']['size'] > $this->items['case']['size']){
            array_push($this->customErrors, "Mainboard ist zu groß für das Gehäuse!");
        }
        if($this->items['gpu']['power'] > $this->items['psu']['power']){
            array_push($this->customErrors, "GPU benötigt größeres Netzteil!");
        }
    }


    public function checkout(){
        $this->validate();
        $this->compatibility();
        if(count($this->customErrors) == 0){
            Order::create([
                'processor' => $this->processor,
                'motherboard' => $this->motherboard,
                'ram' => $this->ram,
                'nvmes' => json_encode($this->items['nvmes']),
                'ssds' => json_encode($this->items['ssds']),
                'gpu' => $this->gpu,
                'case' => $this->case,
                'cooler' => $this->cooler,
                'total' => $this->total_price,
                'type' => $this->customtype,
                'cover' => $this->customcover,
                'fans' => $this->coolerfans,
                'cont' => $this->coolercont,
                'extra' => $this->extracool,
                'name' => $this->name,
                'contact' => $this->contact,
                'message' => $this->message,
                'psu' => $this->psu
            ]);
            session()->flash('success', 'Die Bestellung wurde aufgegeben!');
            $this->reset();
        }
    }
}