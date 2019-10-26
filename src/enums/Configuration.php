<?php declare (strict_types=1);

namespace Klepak\NovaMultiselectFilter\Enums;

class Configuration
{
    public const CLEAR_ON_SELECT = 'clearOnSelect';
    public const CLOSE_ON_SELECT = 'closeOnSelect';
    public const DESELECT_LABEL = 'deselectLabel';
    public const NO_OPTIONS_LABEL = 'noOptionsLabel';
    public const NO_RESULT_LABEL = 'noResultLabel';
    public const PLACEHOLDER = 'placeholder';
    public const SELECT_LABEL = 'selectLabel';
    public const SELECTED_LABEL = 'selectedLabel';
    public const SHOW_LABELS = 'showLabels';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return [
            self::CLEAR_ON_SELECT,
            self::CLOSE_ON_SELECT,
            self::DESELECT_LABEL,
            self::NO_OPTIONS_LABEL,
            self::NO_RESULT_LABEL,
            self::PLACEHOLDER,
            self::SELECT_LABEL,
            self::SELECTED_LABEL,
            self::SHOW_LABELS,
        ];
    }
}
