<?php 
namespace DCTE;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\entity\Entity;
use pocketmine\event\player\PlayerJoinEvent;



class Event implements Listener
{


public function __construct(DCTEconomy $main)
    {
        $this->m = $main;
        }
public function onJoin(PlayerJoinEvent $e){
    $p=$e->getPlayer();
    $n=$p->getName();
  $p->sendmessage("測試");
if($this->m->p->get($n) == null){
$this->m->p->set(strtolower($n),0);
$this->m->p->save();
     } 
   }
 }
  

