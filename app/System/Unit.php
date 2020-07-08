<?php

namespace App\System;

use PhpUnitConversion\Unit\Mass;
use PhpUnitConversion\Unit\Volume;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
	protected $guarded = [];

	public function conversions($amount)
	{
		$unitInstance = $this->getUnitInstance($amount);

		if ($this->isVolumeUnit()) {
			return collect([
				'qt' => $unitInstance->to(Volume\USLiquidQuart::class)->format(),
				'ml' => $unitInstance->to(Volume\MilliLiter::class)->format(),
				'gal' => $unitInstance->to(Volume\USLiquidGallon::class)->format(),
				'l' => $unitInstance->to(Volume\Liter::class)->format(),
			]);
		}

		return collect([
			'oz' => $unitInstance->to(Mass\Ounce::class)->format(),
			'lb' => $unitInstance->to(Mass\Pound::class)->format(),
			'g' => $unitInstance->to(Mass\Gram::class)->format(),
			'kg' => $unitInstance->to(Mass\KiloGram::class)->format(),
		]);
	}

	private function isVolumeUnit()
	{
		return in_array($this->symbol, ['qt', 'ml', 'gal', 'ml', 'l']);
	}

	private function getUnitInstance($amount = 0)
	{
		switch ($this->symbol) {
			case 'oz':
				return new Mass\Ounce($amount);
				break;
			case 'lb':
				return new Mass\Pound($amount);
				break;
			case 'g':
				return new Mass\Gram($amount);
				break;
			case 'kg':
				return new Mass\KiloGram($amount);
				break;
			case 'qt':
				return new Volume\Quart($amount);
				break;
			case 'gal':
				return new Volume\USLiquidGallon($amount);
				break;
			case 'ml':
				return new Volume\MilliLiter($amount);
				break;
			case 'l':
				return new Volume\Liter($amount);
				break;
		}
	}
}
