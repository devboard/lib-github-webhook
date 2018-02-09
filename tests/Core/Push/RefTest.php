<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHubWebhook\Core\Push\Ref;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Push\Ref
 * @group  unit
 */
class RefTest extends TestCase
{
    /**
     * @dataProvider provideBranchReferences
     * @dataProvider provideTagReferences
     */
    public function testItExposesValue(string $reference)
    {
        $sut = new Ref($reference);
        $this->assertEquals($reference, $sut->getValue());
    }

    /**
     * @dataProvider provideBranchReferences
     * @dataProvider provideTagReferences
     */
    public function testItCanBeAutoConvertedToString(string $reference)
    {
        $sut = new Ref($reference);
        $this->assertEquals($reference, (string) $sut);
    }

    /**
     * @dataProvider provideBranchReferences
     * @dataProvider provideTagReferences
     */
    public function testItExposesReferenceName(string $reference, string $referenceName)
    {
        $sut = new Ref($reference);
        $this->assertEquals($referenceName, $sut->getReferenceName());
    }

    /**
     * @dataProvider provideBranchReferences
     */
    public function testItKnowsItIsBranchReference(string $reference)
    {
        $sut = new Ref($reference);
        $this->assertTrue($sut->isBranchReference());
    }

    /**
     * @dataProvider provideBranchReferences
     */
    public function testItKnowsItIsNotTagReference(string $reference)
    {
        $sut = new Ref($reference);
        $this->assertFalse($sut->isTagReference());
    }

    /**
     * @dataProvider provideTagReferences
     */
    public function testItKnowsItIsTagReference(string $reference)
    {
        $sut = new Ref($reference);
        $this->assertTrue($sut->isTagReference());
    }

    /**
     * @dataProvider provideTagReferences
     */
    public function testItKnowsItIsNotBranchReference(string $reference)
    {
        $sut = new Ref($reference);
        $this->assertFalse($sut->isBranchReference());
    }

    /**
     * @dataProvider provideBadReferences
     * @expectedException \Exception
     */
    public function testItThrowsExceptionForBadReferences(string $reference)
    {
        new Ref($reference);
    }

    public function provideBranchReferences(): array
    {
        return [['refs/heads/master', 'master']];
    }

    public function provideTagReferences(): array
    {
        return [['refs/tags/0.1.0', '0.1.0'], ['refs/tags/1.0', '1.0']];
    }

    public function provideBadReferences(): array
    {
        return [['refs/xx/0.1.0']];
    }
}