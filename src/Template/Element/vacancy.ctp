<div class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1"><?= $vacancy->title ?></h5>
    <small><?= $vacancy->created_at->timeAgoInWords() ?></small>
  </div>
  <p class="mb-1"><?= $vacancy->description ?></p>
  <?php
    if ($vacancy->workplace)
      echo $this->Html->tag('p', "<strong>Local:</strong> {$vacancy->workplace}", ['class' => 'mb-1']);

    if ($vacancy->salary)
      echo $this->Html->tag('p', "<strong>Salário:</strong> {$this->Number->currency($vacancy->salary, 'USD')}");
  ?>
</div>
