<?php
$this->Paginator->setTemplates([
  'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
  'current' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
]);

if ($this->Paginator->hasPrev() || $this->Paginator->hasNext())
  echo $this->Html->tag('div', join([

    $this->Html->tag('div', $this->Paginator->prev('<span cass="fa fa-angle-left"></span>', array(
      'class'=>'btn'.(!$this->Paginator->hasPrev() ? ' current disabled' : ''),
      'escape' => false
    )), ['class' => 'btn-group hidden-xs']),

    $this->Html->tag('div',
      $this->Html->tag('ul', $this->Paginator->numbers(['modulus' => 4]), ['class' => 'pagination']),
      ['class' => 'btn-group']),

    $this->Html->tag('div',
      $this->Paginator->next('<span cass="fa fa-angle-right"></span>', ['escape' => false]),
      ['class' => 'btn-group hidden-xs'])

  ]), ['class' => 'pagination justify-content-end mb-0', 'role' => 'toolbar']);
