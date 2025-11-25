<?php

<<<<<<< HEAD
declare(strict_types=1);

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Modules\User\Contracts\TeamContract;
use Modules\User\Models\Role;
use Modules\User\Models\Team;
use Modules\User\Models\User;
=======

>>>>>>> fbc8f8e (.)

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->team = Team::factory()->create();
    $this->personalTeam = Team::factory()->create([
        'user_id' => $this->user->id,
        'personal_team' => true,
    ]);
});

test('it correctly checks if user belongs to teams', function () {
    // Test: User without teams
    $userWithoutTeams = User::factory()->create();
    expect($userWithoutTeams->belongsToTeams())->toBeFalse();

    // Test: User with owned team
    expect($this->user->belongsToTeams())->toBeTrue();

    // Test: User with team membership
    $memberUser = User::factory()->create();
    $memberUser->teams()->attach($this->team->id, ['role' => 'member']);
    expect($memberUser->belongsToTeams())->toBeTrue();
});

test('it correctly checks if user belongs to specific team', function () {
    // Test: Null team
    expect($this->user->belongsToTeam(null))->toBeFalse();

    // Test: Owned team
    expect($this->user->belongsToTeam($this->personalTeam))->toBeTrue();

    // Test: Member team
    $this->user->teams()->attach($this->team->id, ['role' => 'member']);
    expect($this->user->belongsToTeam($this->team))->toBeTrue();

    // Test: Non-member team
    $otherTeam = Team::factory()->create();
    expect($this->user->belongsToTeam($otherTeam))->toBeFalse();
});

test('it correctly checks team ownership', function () {
    // Test: Owned team
    expect($this->user->ownsTeam($this->personalTeam))->toBeTrue();

    // Test: Non-owned team
    expect($this->user->ownsTeam($this->team))->toBeFalse();

    // Test: Member team (not owner)
    $this->user->teams()->attach($this->team->id, ['role' => 'member']);
    expect($this->user->ownsTeam($this->team))->toBeFalse();
});

test('it uses belongs to many x for teams relationship', function () {
    // Verify teams() relationship returns BelongsToMany
    $relation = $this->user->teams();
<<<<<<< HEAD
    expect($relation)
        ->toBeInstanceOf(BelongsToMany::class)
        ->getTable()
        ->toBe('team_user');
=======
    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class)
        ->getTable()->toBe('team_user');
>>>>>>> fbc8f8e (.)
});

test('it correctly manages current team', function () {
    // Test: Switch to valid team
    $this->user->teams()->attach($this->team->id, ['role' => 'member']);
    $result = $this->user->switchTeam($this->team);

<<<<<<< HEAD
    expect($result)->toBeTrue()->and($this->user->current_team_id)->toBe($this->team->id);

    // Test: Switch to null
    $result = $this->user->switchTeam(null);
    expect($result)->toBeTrue()->and($this->user->current_team_id)->toBeNull();
=======
    expect($result)->toBeTrue()
        ->and($this->user->current_team_id)->toBe($this->team->id);

    // Test: Switch to null
    $result = $this->user->switchTeam(null);
    expect($result)->toBeTrue()
        ->and($this->user->current_team_id)->toBeNull();
>>>>>>> fbc8f8e (.)

    // Test: Switch to non-member team
    $otherTeam = Team::factory()->create();
    $result = $this->user->switchTeam($otherTeam);
    expect($result)->toBeFalse();
});

test('it correctly identifies current team', function () {
    $this->user->switchTeam($this->personalTeam);

<<<<<<< HEAD
    expect($this->user->isCurrentTeam($this->personalTeam))
        ->toBeTrue()
        ->and($this->user->isCurrentTeam($this->team))
        ->toBeFalse();
=======
    expect($this->user->isCurrentTeam($this->personalTeam))->toBeTrue()
        ->and($this->user->isCurrentTeam($this->team))->toBeFalse();
>>>>>>> fbc8f8e (.)
});

test('it returns all teams user owns or belongs to', function () {
    // Add user as member of a team
    $this->user->teams()->attach($this->team->id, ['role' => 'member']);

    $allTeams = $this->user->allTeams();

    expect($allTeams)
        ->toBeInstanceOf(Collection::class)
<<<<<<< HEAD
        ->toHaveCount(2)
        ->toContain($this->personalTeam)
        ->toContain($this->team); // personal team + member team
=======
        ->toHaveCount(2) // personal team + member team
        ->toContain($this->personalTeam)
        ->toContain($this->team);
>>>>>>> fbc8f8e (.)
});

test('it returns owned teams', function () {
    $ownedTeams = $this->user->ownedTeams;

<<<<<<< HEAD
    expect($ownedTeams)->toBeInstanceOf(Collection::class)->toHaveCount(1)->toContain($this->personalTeam);
=======
    expect($ownedTeams)
        ->toBeInstanceOf(Collection::class)
        ->toHaveCount(1)
        ->toContain($this->personalTeam);
>>>>>>> fbc8f8e (.)
});

test('it returns personal team', function () {
    $personalTeam = $this->user->personalTeam();

    expect($personalTeam)
        ->toBeInstanceOf(TeamContract::class)
        ->id->toBe($this->personalTeam->id)
        ->personal_team->toBeTrue();
});

test('it correctly determines team role', function () {
    // Test: Owner role
    $role = $this->user->teamRole($this->personalTeam);
<<<<<<< HEAD
    expect($role)->toBeInstanceOf(Role::class)->name->toBe('owner');
=======
    expect($role)
        ->toBeInstanceOf(Role::class)
        ->name->toBe('owner');
>>>>>>> fbc8f8e (.)

    // Test: Member role
    $this->user->teams()->attach($this->team->id, ['role' => 'admin']);
    $role = $this->user->teamRole($this->team);
<<<<<<< HEAD
    expect($role)->toBeInstanceOf(Role::class)->name->toBe('admin');
=======
    expect($role)
        ->toBeInstanceOf(Role::class)
        ->name->toBe('admin');
>>>>>>> fbc8f8e (.)

    // Test: No role
    $otherUser = User::factory()->create();
    expect($otherUser->teamRole($this->team))->toBeNull();
});

test('it provides team role name helper', function () {
    // Test: Owner role name
    $roleName = $this->user->teamRoleName($this->personalTeam);
    expect($roleName)->toBe('owner');

    // Test: Member role name - detach first to avoid duplicates
    $this->user->teams()->detach($this->team->id);
    $this->user->teams()->attach($this->team->id, ['role' => 'admin']);
    $roleName = $this->user->teamRoleName($this->team);
    expect($roleName)->toBe('admin');

    // Test: Unknown role
    $otherTeam = Team::factory()->create();
    $roleName = $this->user->teamRoleName($otherTeam);
    expect($roleName)->toBe('Unknown');
});

test('it correctly checks team role', function () {
    // Test: Has role
    $this->user->teams()->attach($this->team->id, ['role' => 'admin']);
<<<<<<< HEAD
    expect($this->user->hasTeamRole($this->team, 'admin'))
        ->toBeTrue()
        ->and($this->user->hasTeamRole($this->team, 'editor'))
        ->toBeFalse();

    // Test: Owner has all roles
    expect($this->user->hasTeamRole($this->personalTeam, 'admin'))
        ->toBeTrue()
        ->and($this->user->hasTeamRole($this->personalTeam, 'editor'))
        ->toBeTrue();
=======
    expect($this->user->hasTeamRole($this->team, 'admin'))->toBeTrue()
        ->and($this->user->hasTeamRole($this->team, 'editor'))->toBeFalse();

    // Test: Owner has all roles
    expect($this->user->hasTeamRole($this->personalTeam, 'admin'))->toBeTrue()
        ->and($this->user->hasTeamRole($this->personalTeam, 'editor'))->toBeTrue();
>>>>>>> fbc8f8e (.)

    // Test: No role
    $otherTeam = Team::factory()->create();
    expect($this->user->hasTeamRole($otherTeam, 'admin'))->toBeFalse();
});

test('it correctly manages team permissions', function () {
    // Test: Owner has all permissions
    expect($this->user->hasTeamPermission($this->personalTeam, 'edit-team'))->toBeTrue();

    // Test: Member with specific permission
    $this->user->teams()->attach($this->team->id, [
        'role' => 'editor',
<<<<<<< HEAD
        'permissions' => json_encode(['edit-content' => true]),
    ]);

    expect($this->user->hasTeamPermission($this->team, 'edit-content'))
        ->toBeTrue()
        ->and($this->user->hasTeamPermission($this->team, 'delete-content'))
        ->toBeFalse();
=======

    expect($this->user->hasTeamPermission($this->team, 'edit-content'))->toBeTrue()
        ->and($this->user->hasTeamPermission($this->team, 'delete-content'))->toBeFalse();
>>>>>>> fbc8f8e (.)
});

test('it handles edge cases', function () {
    // Test: User without ID
<<<<<<< HEAD
    $newUser = new User();
=======

>>>>>>> fbc8f8e (.)
    expect($newUser->belongsToTeams())->toBeFalse();

    // Test: Team without owner
    $teamWithoutOwner = Team::factory()->create(['user_id' => null]);
    expect($this->user->ownsTeam($teamWithoutOwner))->toBeFalse();

    // Test: Non-existent team
    $nonExistentTeam = new Team(['id' => 9999]);
    expect($this->user->belongsToTeam($nonExistentTeam))->toBeFalse();
});
