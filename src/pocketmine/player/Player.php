<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\player;

use pocketmine\level\Level;

class Player {

	protected \pocketmine\Player $player;

	public function __construct(\pocketmine\Player $player){
		$this->player = $player;
	}

	public function getNetworkSession() : \pocketmine\Player
	{
		return $this->player;
	}

	/*public function getPlayerInfo(): self
	{
		return $this;
	}*/ //soon implement

	public function getWorld() : Level
	{
		return $this->player->getLevelNonNull();
	}
}
