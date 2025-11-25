<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Presets;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\ViewAction;

/**
 * Action Presets for common Filament actions.
 *
 * Provides standardized action groups to reduce code duplication
 * across List pages in all modules.
 *
 * Usage:
 * ```php
 * public function getTableActions(): array
 * {
 *     return ActionPresets::crud();
 * }
 *
 * public function getTableBulkActions(): array
 * {
 *     return ActionPresets::bulkCrud();
 * }
 * ```
 */
class ActionPresets
{
    /**
     * Standard CRUD actions (View, Edit, Delete).
     *
     * @return array<string, Action>
     */
    public static function crud(bool $iconButton = true): array
    {
        $actions = [
            'view' => ViewAction::make(),
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
        ];

        if ($iconButton) {
            foreach ($actions as $action) {
                $action->iconButton();
            }
        }

        return $actions;
    }

    /**
     * CRUD actions with replicate.
     *
     * @return array<string, Action>
     */
    public static function crudWithReplicate(bool $iconButton = true): array
    {
        $actions = self::crud($iconButton);
        $actions['replicate'] = ReplicateAction::make();

        if ($iconButton) {
            $actions['replicate']->iconButton();
        }

        return $actions;
    }

    /**
     * View only action.
     *
     * @return array<string, Action>
     */
    public static function viewOnly(bool $iconButton = true): array
    {
        $action = ViewAction::make();

        if ($iconButton) {
            $action->iconButton();
        }

        return ['view' => $action];
    }

    /**
     * Edit and Delete actions (no view).
     *
     * @return array<string, Action>
     */
    public static function editDelete(bool $iconButton = true): array
    {
        $actions = [
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
        ];

        if ($iconButton) {
            foreach ($actions as $action) {
                $action->iconButton();
            }
        }

        return $actions;
    }

    /**
     * Standard bulk actions (Delete, Export).
     *
     * @return array<string, Action>
     */
    public static function bulkCrud(): array
    {
        return [
            'delete' => DeleteBulkAction::make()
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation(),
            'export' => ExportBulkAction::make()
                ->icon('heroicon-o-arrow-down-tray'),
        ];
    }

    /**
     * Delete bulk action only.
     *
     * @return array<string, Action>
     */
    public static function bulkDelete(): array
    {
        return [
            'delete' => DeleteBulkAction::make()
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation(),
        ];
    }

    /**
     * Export bulk action only.
     *
     * @return array<string, Action>
     */
    public static function bulkExport(): array
    {
        return [
            'export' => ExportBulkAction::make()
                ->icon('heroicon-o-arrow-down-tray'),
        ];
    }

    /**
     * Header actions for List pages (Create).
     *
     * @return array<string, Action>
     */
    public static function headerCreate(): array
    {
        return [
            'create' => CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }

    /**
     * Header actions with custom actions.
     *
     * @param  array<string, Action>  $customActions
     * @return array<string, Action>
     */
    public static function headerWithCustom(array $customActions = []): array
    {
        return array_merge(
            self::headerCreate(),
            $customActions
        );
    }

    /**
     * Grouped CRUD actions (for compact display).
     */
    public static function groupedCrud(): ActionGroup
    {
        return ActionGroup::make([
            ViewAction::make(),
            EditAction::make(),
            DeleteAction::make(),
        ]);
    }

    /**
     * Merge preset actions with custom actions.
     *
     * @param  array<string, Action>  $preset
     * @param  array<string, Action>  $custom
     * @return array<string, Action>
     */
    public static function merge(array $preset, array $custom): array
    {
        return array_merge($preset, $custom);
    }

    /**
     * Add custom action before preset actions.
     *
     * @param  array<string, Action>  $preset
     * @param  array<string, Action>  $custom
     * @return array<string, Action>
     */
    public static function prepend(array $preset, array $custom): array
    {
        return array_merge($custom, $preset);
    }
}
