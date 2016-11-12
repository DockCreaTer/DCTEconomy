<?php

/*
 * DCTEconomy, the economy plugin with for PocketMine-MP
 * Copyright (C) 2016-2016  DockCreaTer <dockcreater@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
namespace DCTE;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\Utils;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandExecutor;

class DCTEconomy extends PluginBase implements CommandExecutor, Listener
{
  private static $dct;
  public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
       $this->getServer()->getPluginManager()->registerEvents(new Event($this), $this);
        @mkdir($this->getDataFolder());   
   $this->p=  new Config($this->getDataFolder()."PlayerMoney.yml", Config::YAML, array());
   $this->config=  new Config($this->getDataFolder()."Config.yml", Config::YAML, ["負債模式"=>"關"]);
    }
  

   public function onLoad(){
		self::$dct= $this;
}//
   public static function DCTE(){
		return static::$dct;
	}//
  public function money($p){
    if($this->in($p) == "ok"){
  $n=$p->getName();
  return $this->conf($n);
  }else{
  return false;
  //不是玩家
  }//-//
  }//--//
  public function deduction($p,$deduction){
 if($this->in($p) == "ok"){
  $n=$p->getName();
  $export=$this->conf(strtolower($n)) - $deduction;
  if($export < 0){
  if($this->config->get("負債模式")=="開"){
  $this->setconf($n,$export);
  $export=$this->conf($n);
  return $export;
  }else{
  $str=0;
  $this->setconf($n,$str);
  $export=$this->conf($n);
  return $export;
  }//----//
  }//---//
  $this->setconf($n,$export);
  // $this->getLogger()->info("$n $export");
  return $this->conf($n);
  
  }else{
  return false;
  //不是玩家
  }//-//
  }//--//
  public function add($p,$add){
  if($this->in($p) == "ok"){
  $n=$p->getName();
  $add=$this->conf($n) + $add;
  $this->setconf($n,$add);
  $add=$this->conf($n);
  
  }else{
  return false;
  //不是玩家
  }//-//
  }//--//
  public function in($p){
  if($p instanceof Player){
  $ok="ok";
  return $ok;
  }else{
  $no="no";
  return $no;
  }//-//
  }//--//
  public function conf($n){
  $conf=new Config($this->getDataFolder()."PlayerMoney.yml", Config::YAML, array());

  $n=strtolower($n);
  return $conf->get(strtolower($n));
  }//-//
  public function setconf($n,$val){
  $conf=new Config($this->getDataFolder()."PlayerMoney.yml", Config::YAML, array());
  $conf->set(strtolower($n),$val);
  $conf->save();
  }//-//

  }
