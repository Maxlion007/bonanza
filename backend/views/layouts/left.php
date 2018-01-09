<aside class="main-sidebar">

    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [

                    ['label' => 'Users', 'icon' => 'folder', 'url' => ['/user/index'], 'active' => $this->context->id == 'user'],
                    ['label' => 'Friend Requests', 'icon' => 'folder', 'url' => ['/friend-request/index'], 'active' => $this->context->id == 'friend-request'],
                    ['label' => 'User suspensions', 'icon' => 'folder', 'url' => ['/user-suspension/index'], 'active' => $this->context->id == 'user-suspension'],
                    ['label' => 'Countries', 'icon' => 'folder', 'url' => ['/country/index'], 'active' => $this->context->id == 'country'],
                    ['label' => 'Messages', 'icon' => 'folder', 'url' => ['/message/index'], 'active' => $this->context->id == 'message'],
                    ['label' => 'User Transactions', 'icon' => 'folder', 'url' => ['/user-transaction/index'], 'active' => $this->context->id == 'user-transaction'],
                    ['label' => 'Game Transactions', 'icon' => 'folder', 'url' => ['/game-transaction/index'], 'active' => $this->context->id == 'game-transaction'],
                    ['label' => 'Tables', 'icon' => 'folder', 'url' => ['/table/index'], 'active' => $this->context->id == 'table'],
                    ['label' => 'Table Logs', 'icon' => 'folder', 'url' => ['/table-log/index'], 'active' => $this->context->id == 'table-log'],
                    ['label' => 'Game Conditions', 'icon' => 'folder', 'url' => ['/game-condition/index'], 'active' => $this->context->id == 'game-condition'],
                    ['label' => 'Condition Values', 'icon' => 'folder', 'url' => ['/condition-value/index'], 'active' => $this->context->id == 'condition-value'],

                ],
            ]
        ) ?>

    </section>

</aside>
