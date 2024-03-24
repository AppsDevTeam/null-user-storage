<?php

namespace ADT\NullUserStorage;

use Nette\Security\IIdentity;
use Nette\Security\SimpleIdentity;
use Nette\Security\UserStorage;

class NullUserStorage implements UserStorage
{
	private ?string $uid = null;

	public function saveAuthentication(IIdentity $identity): void
	{
		$this->uid = $identity->getId();
	}

	public function clearAuthentication(bool $clearIdentity): void
	{
		$this->uid = '';
	}

	public function getState(): array
	{
		if ($this->uid === null) {
			$this->uid = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION'] ?? '');
		}

		return $this->uid
			? [true, new SimpleIdentity($this->uid), null]
			: [false, null, null];
	}

	public function setExpiration(?string $expire, bool $clearIdentity): void
	{

	}
}