<?php

/*
 *               _ _
 *         /\   | | |
 *        /  \  | | |_ __ _ _   _
 *       / /\ \ | | __/ _` | | | |
 *      / ____ \| | || (_| | |_| |
 *     /_/    \_|_|\__\__,_|\__, |
 *                           __/ |
 *                          |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author TuranicTeam
 * @link https://github.com/TuranicTeam/Altay
 *
 */

declare(strict_types=1);

namespace pocketmine\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\lang\TranslationContainer;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;
use pocketmine\network\mcpe\protocol\StopSoundPacket;
use pocketmine\network\mcpe\protocol\types\CommandParameter;
use pocketmine\utils\TextFormat;
use function strlen;

class StopSoundCommand extends VanillaCommand{

	public function __construct(string $name){
		parent::__construct($name, "Stops a sound or all sounds", "/stopsound <player: target> [sound: string]", [], [
			[
				new CommandParameter("player", AvailableCommandsPacket::ARG_TYPE_TARGET, false),
				new CommandParameter("sound", AvailableCommandsPacket::ARG_TYPE_STRING)
			]
		]);

		$this->setPermission("altay.command.stopsound");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$this->testPermission($sender)){
			return true;
		}

		if(empty($args)){
			throw new InvalidCommandSyntaxException();
		}

		$player = $sender->getServer()->getPlayer($args[0]);

		if($player === null){
			$sender->sendMessage(new TranslationContainer(TextFormat::RED . "%commands.generic.player.notFound"));
			return true;
		}

		$soundName = $args[1] ?? "";
		$stopAll = strlen($soundName) === 0;

		$pk = new StopSoundPacket();
		$pk->soundName = $soundName;
		$pk->stopAll = $stopAll;
		$player->sendDataPacket($pk);

		$message = $stopAll ? new TranslationContainer("commands.stopsound.success.all", [$player->getName()]) : new TranslationContainer("commands.stopsound.success", [
			$soundName, $player->getName()
		]);
		$player->sendMessage($message);

		return true;
	}
}
