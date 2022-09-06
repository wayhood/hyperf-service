# hyperf-service
A Service Annotation for Hyperf


## Example 

auto set dependencies

TestSerivce -> TestServiceImpl


```
<?php

namespace App\Service;

interface TestService
{
    public function getTest(): string;
}
```

```
<?php

namespace App\Service\Impl;

use App\Service\TestService;
use Wayhood\Service\Annotation\Service;

#[Service]
class TestServiceImpl implements TestService
{
    public function getTest(): string {
        return "abc";
    }
}
```

```
namespace App\Controller;

use App\Service\TestService;
use Hyperf\Di\Annotation\Inject;

class IndexController extends AbstractController
{
    #[Inject]
    protected TestService $testService;

    public function index()
    {
        return $this->testService->getTest();
    }
}
```


