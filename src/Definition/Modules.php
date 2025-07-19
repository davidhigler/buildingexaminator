<?php

namespace App\Definition;

class Modules
{
    const MODULE_PORTFOLIO = 'portfolio';

    const MODULE_INSPECTIONS = 'inspections';

    const MODULE_REPORTS = 'reports';

    const MODULE_MANAGEMENT = 'management';

    const MODULE_ADMIN = 'admin';

    const AVAILABLE = [
        self::MODULE_PORTFOLIO,
        self::MODULE_INSPECTIONS,
        self::MODULE_REPORTS,
        self::MODULE_MANAGEMENT,
        self::MODULE_ADMIN
    ];
}