<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Support;

use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;

/**
 * Preset action configurations for Filament tables.
 *
 * Reduces boilerplate by providing common action patterns.
 * Implements the strategy documented in METODI_DUPLICATI_ANALISI.md
 *
 * Usage:
 * ```php
 * public static function getTableActions(): array
 * {
 *     return ActionPresets::crud();
 * }
 * ```
 *
 * @see docs/METODI_DUPLICATI_ANALISI.md - Proposta 3: Action Presets
 */
class ActionPresets
{
    /**
     * Standard CRUD actions (View, Edit, Delete).
     *
     * Implements the most common pattern found in 90% of resources.
     *
     * @return array<string, Action>
     */
    public static function crud(): array
    {
        return [
            'view' => ViewAction::make()
                ->iconButton()
                ->tooltip(__('xot::actions.view')),

            'edit' => EditAction::make()
                ->iconButton()
                ->tooltip(__('xot::actions.edit')),

            'delete' => DeleteAction::make()
                ->iconButton()
                ->requiresConfirmation()
                ->tooltip(__('xot::actions.delete')),
        ];
    }

    /**
     * View and Edit actions only (no delete).
     *
     * For resources where deletion is managed separately or not allowed.
     *
     * @return array<string, Action>
     */
    public static function viewEdit(): array
    {
        return [
            'view' => ViewAction::make()
                ->iconButton()
                ->tooltip(__('xot::actions.view')),

            'edit' => EditAction::make()
                ->iconButton()
                ->tooltip(__('xot::actions.edit')),
        ];
    }

    /**
     * View only action.
     *
     * For read-only resources.
     *
     * @return array<string, Action>
     */
    public static function viewOnly(): array
    {
        return [
            'view' => ViewAction::make()
                ->iconButton()
                ->tooltip(__('xot::actions.view')),
        ];
    }

    /**
     * Edit and Delete actions only (no view).
     *
     * For resources where view page is not needed.
     *
     * @return array<string, Action>
     */
    public static function editDelete(): array
    {
        return [
            'edit' => EditAction::make()
                ->iconButton()
                ->tooltip(__('xot::actions.edit')),

            'delete' => DeleteAction::make()
                ->iconButton()
                ->requiresConfirmation()
                ->tooltip(__('xot::actions.delete')),
        ];
    }

    /**
     * Standard bulk actions (Delete only).
     *
     * Implements the most common pattern found in 95% of resources.
     *
     * @return array<string, BulkAction>
     */
    public static function bulkCrud(): array
    {
        return [
            'delete' => DeleteBulkAction::make()
                ->requiresConfirmation(),
        ];
    }

    /**
     * Bulk actions with soft delete support.
     *
     * For resources using SoftDeletes trait.
     *
     * @return array<string, BulkAction>
     */
    public static function bulkSoftDelete(): array
    {
        return [
            'delete' => DeleteBulkAction::make()
                ->requiresConfirmation()
                ->label(__('xot::actions.delete')),

            'restore' => RestoreBulkAction::make()
                ->label(__('xot::actions.restore')),

            'forceDelete' => ForceDeleteBulkAction::make()
                ->requiresConfirmation()
                ->label(__('xot::actions.force_delete')),
        ];
    }

    /**
     * Delete only bulk action.
     *
     * Minimal bulk action set.
     *
     * @return array<string, BulkAction>
     */
    public static function bulkDeleteOnly(): array
    {
        return [
            'delete' => DeleteBulkAction::make()
                ->requiresConfirmation(),
        ];
    }
}
