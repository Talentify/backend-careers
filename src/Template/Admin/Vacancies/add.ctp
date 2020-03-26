<?php
$this->Html->script([
  '/plugins/inputmask/inputmask.js',
  'vacancies.js'
], ['block' => true]);

echo $this->Form->create($entity, ['method' => 'POST']);

echo $this->Html->tag('div',
  $this->Form->control('title', ['label' => 'Título', 'class' => 'form-control']),
  ['class' => 'form-group']
);
echo $this->Html->tag('div',
  $this->Form->control('description', ['label' => 'Descrição', 'class' => 'form-control']),
  ['class' => 'form-group']
);
echo $this->Html->tag('div',
  $this->Form->control('workplace', ['label' => 'Local', 'class' => 'form-control']),
  ['class' => 'form-group']
);
echo $this->Html->tag('div',
  $this->Form->control('salary', ['label' => 'Salário', 'class' => 'form-control', 'type' => 'text', 'data-inputmask' => "'alias': 'currency'"]),
  ['class' => 'form-group']
);

echo $this->Html->tag('div',
  $this->Form->control('status', ['label' => 'Status', 'class' => 'form-control', 'options' => ['active' => 'Ativa', 'inactive' => 'Inativa']]),
  ['class' => 'form-group']
);

echo $this->Html->tag('div',
  '<button class="btn btn-primary">Enviar</button>',
  ['class' => 'col-12 text-right px-0 mb-3']
);

echo $this->Form->end();
