<?php
echo $this->Form->create(null, ['method' => 'POST']);

echo $this->Html->tag('div',
  $this->Form->control('email', ['label' => 'Email', 'class' => 'form-control']),
  ['class' => 'form-group']
);
echo $this->Html->tag('div',
  $this->Form->control('password', ['label' => 'Password', 'type' => 'password', 'class' => 'form-control']),
  ['class' => 'form-group']
);
echo $this->Html->tag('div',
  '<button class="btn btn-primary">Login</button>',
  ['class' => 'col-12 text-right px-0']
);
echo $this->Form->end();
