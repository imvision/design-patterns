<?php

// DB
// Module      AccessLevels
// finance     crud
// users       ru

$Modules = [];

$FinanceModule = [
    'name'  => 'Finance',
    'path'  => 'finance',
    'areas' => [
        [
            'name' : 'Pending Withdrawals',
            'path' : 'pending-withdrawals',
            'accessType' : 'r'
        ],
        [
            'name' : 'Credit Report',
            'path' : 'credit-report',
            'accessType' : 'r'
        ],
        [
            'name' : 'Invoices',
            'path' : 'invoices',
            'accessType' : 'r'
        ]
    ]
];

$Modules[] = $FinanceModule;

$current_module = 'finance';
$current_area = 'pending-withdrawals';
?>

<ul>
    <?php foreach($Modules as $Module): ?>
        
        <?php if (! ModuleAccessible('r')) continue; ?>
        <li>
            <a href="<?php echo $Modules['path'] ?>"><?php echo $Modules['name'] ?></a>
            <ul>
            <?php foreach($Module['areas'] as $Area): ?>
                <li>
                    <a href="<?php echo $Area['path'] ?>"><?php echo $Area['name'] ?></a>
                </li>
            <?php endforeach;?>
            </ul>
        </li>
    <?php endforeach;?>
</ul
