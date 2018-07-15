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
    public function testItExposesValue(string $reference): void
    {
        $sut = new Ref($reference);
        self::assertEquals($reference, $sut->getValue());
    }

    /**
     * @dataProvider provideBranchReferences
     * @dataProvider provideTagReferences
     */
    public function testItCanBeAutoConvertedToString(string $reference): void
    {
        $sut = new Ref($reference);
        self::assertEquals($reference, (string) $sut);
    }

    /**
     * @dataProvider provideBranchReferences
     * @dataProvider provideTagReferences
     */
    public function testItExposesReferenceName(string $reference, string $referenceName): void
    {
        $sut = new Ref($reference);
        self::assertEquals($referenceName, $sut->getReferenceName());
    }

    /**
     * @dataProvider provideBranchReferences
     */
    public function testItKnowsItIsBranchReference(string $reference): void
    {
        $sut = new Ref($reference);
        self::assertTrue($sut->isBranchReference());
    }

    /**
     * @dataProvider provideBranchReferences
     */
    public function testItKnowsItIsNotTagReference(string $reference): void
    {
        $sut = new Ref($reference);
        self::assertFalse($sut->isTagReference());
    }

    /**
     * @dataProvider provideTagReferences
     */
    public function testItKnowsItIsTagReference(string $reference): void
    {
        $sut = new Ref($reference);
        self::assertTrue($sut->isTagReference());
    }

    /**
     * @dataProvider provideTagReferences
     */
    public function testItKnowsItIsNotBranchReference(string $reference): void
    {
        $sut = new Ref($reference);
        self::assertFalse($sut->isBranchReference());
    }

    /**
     * @dataProvider provideBadReferences
     * @expectedException \Exception
     */
    public function testItThrowsExceptionForBadReferences(string $reference): void
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
