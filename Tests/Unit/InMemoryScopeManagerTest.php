<?php

declare(strict_types=1);

namespace Trikoder\Bundle\OAuth2Bundle\Tests\Unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use Trikoder\Bundle\OAuth2Bundle\Manager\InMemory\AccessTokenManager as InMemoryAccessTokenManager;
use Trikoder\Bundle\OAuth2Bundle\Manager\InMemory\ScopeManager;
use Trikoder\Bundle\OAuth2Bundle\Model\AccessToken;
use Trikoder\Bundle\OAuth2Bundle\Model\Client;
use Trikoder\Bundle\OAuth2Bundle\Model\Scope;

final class InMemoryScopeManagerTest extends TestCase
{
    public function testList(): void
    {
        $inMemoryScopeManager = new ScopeManager();

        $reflectionProperty = new ReflectionProperty(ScopeManager::class, 'scopes');
        $reflectionProperty->setAccessible(true);
        $scopes = ['my_scope' => new Scope('my_scope')];
        $reflectionProperty->setValue($inMemoryScopeManager, $scopes);

        $this->assertSame($inMemoryScopeManager->list(), $reflectionProperty->getValue($inMemoryScopeManager));
    }

    public function testSave(): void
    {
        $inMemoryScopeManager = new ScopeManager();

        $reflectionProperty = new ReflectionProperty(ScopeManager::class, 'scopes');
        $reflectionProperty->setAccessible(true);
        $scope = new Scope('my_scope');

        $inMemoryScopeManager->save($scope);
        $this->assertSame(['my_scope' => $scope], $reflectionProperty->getValue($inMemoryScopeManager));
    }

    public function testFind(): void
    {
        $inMemoryScopeManager = new ScopeManager();

        $reflectionProperty = new ReflectionProperty(ScopeManager::class, 'scopes');
        $reflectionProperty->setAccessible(true);
        $scope = new Scope('my_scope');
        $reflectionProperty->setValue($inMemoryScopeManager, ['my_scope' => $scope]);

        $this->assertSame($inMemoryScopeManager->find('my_scope'), $scope);
        $this->assertSame($inMemoryScopeManager->find('my_inexisting_scope'), null);
    }
}
