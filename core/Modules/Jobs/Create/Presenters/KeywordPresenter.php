<?php

namespace Recruitment\Modules\Jobs\Create\Presenters;

class KeywordPresenter
{
    private $keyword;
    private $presenter;

    public function __construct(string $keyword)
    {
        $this->keyword = $keyword;
    }

    public function present(): self
    {
        $keywords = explode(',', $this->keyword);
        foreach ($keywords as $key => $keyword) {
            $this->presenter['word' . $key] = strtoupper($keyword);
        }
        return $this;
    }

    public function toJson(): string
    {
        return json_encode($this->presenter);
    }
}
