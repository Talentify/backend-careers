<?php

namespace Tests\Feature;

use App\Http\Traits\SetJobStatusTrait;
use Tests\TestCase;

class SetJobStatusTraitTest extends TestCase
{
    public function test_set_status_open()
    {
        $status = SetJobStatusTrait::setJobStatus('open');

        $this->assertEquals('open', $status);
    }

    public function test_set_status_close()
    {
        $status = SetJobStatusTrait::setJobStatus('close');

        $this->assertEquals('close', $status);
    }

    public function test_set_status_nonexistent()
    {
        $status = SetJobStatusTrait::setJobStatus('non_existent_status');

        $this->assertEquals('open', $status);
    }
}
