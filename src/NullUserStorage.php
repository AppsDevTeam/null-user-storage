<?php

namespace ADT\NullUserStorage;

use Nette\Security\IIdentity;
use Nette\Security\UserStorage;

class NullUserStorage implements UserStorage
{
	private ?IIdentity $identity = null;

	function saveAuthentication(IIdentity $identity): void
	{
		$this->identity = $identity;
	}

	function clearAuthentication(bool $clearIdentity): void
	{
		$this->identity = null;
	}

	function getState(): array
	{
		return [true, $this->identity, null];
	}

	function setExpiration(?string $expire, bool $clearIdentity): void
	{

	}
}