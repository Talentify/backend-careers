<div class="row">
  <h3 class="col mb-4">Todas as vagas <small><?= $this->Html->link('(Anunciar)', ['controller' => 'Vacancies', 'action' => 'add']); ?></small></h3>
  <h4 class="col text-right"><small><?= $this->Html->link('Sair', ['controller' => 'Users', 'action' => 'logout']) ?></small></h4>
</div>
<?php
if ($total) {
  // Show list
  echo $this->Html->tag('div',
    join( array_map(function ($vacancy) {
      return $this->element('Admin/vacancy', ['vacancy' => $vacancy]);
    }, $items->toArray()) ),
    ['class' => 'list-group mb-3']);

  // Show pagination
  echo $this->element('pagination');
}
// No vacancy available message
else
  echo $this->Html->tag('h4', 'Nenhuma vaga está em aberto :(', ['class' => 'text-center']);
