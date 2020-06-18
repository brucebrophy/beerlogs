<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\System\Unit;
use Illuminate\Support\Collection;

class UnitTest extends TestCase
{
	public function testUnitConversionsReturnsCollectionInstance()
	{
		$unit = new Unit();
		$unit->symbol = 'g';

		$collection = $unit->conversions(100);

		$this->assertInstanceOf(Collection::class, $collection);
    }

	public function testUnitReturnsCorrectMassConversions()
	{
		$unit = new Unit();
		$unit->symbol = 'g';

		$conversions = $unit->conversions(100);

		$this->assertSame('100.000 g', $conversions->get('g'));
		$this->assertSame('3.527 oz', $conversions->get('oz'));
		$this->assertSame('0.220 lb', $conversions->get('lb'));
		$this->assertSame('0.100 kg', $conversions->get('kg'));
	}

	public function testUnitReturnsCorrectVolumeConversions()
	{
		$unit = new Unit();
		$unit->symbol = 'gal';

		$conversions = $unit->conversions(5);

		$this->assertSame('20.000 qt', $conversions->get('qt'));
		$this->assertSame('18927.059 ml', $conversions->get('ml'));
		$this->assertSame('5.000 gal', $conversions->get('gal'));
		$this->assertSame('18.927 l', $conversions->get('l'));
	}
}
