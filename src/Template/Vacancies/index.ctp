<h2 class="text-center mb-4">Vagas em aberto</h2>
<?php
if ($total) {
  // Show list
  echo $this->Html->tag('div',
    join( array_map(function ($vacancy) {
      return $this->element('vacancy', ['vacancy' => $vacancy]);
    }, $items->toArray()) ),
    ['class' => 'list-group mb-3']);

  // Show pagination
  echo $this->element('pagination');
}
// No vacancy available message
else
  echo $this->Html->tag('h4', 'Nenhuma vaga está em aberto :(', ['class' => 'text-center']);
