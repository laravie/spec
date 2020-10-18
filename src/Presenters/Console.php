<?php

namespace Laravie\Spec\Presenters;

use Illuminate\Console\OutputStyle;
use Illuminate\Support\Collection;
use Laravie\Spec\Contracts\Presenter;
use Laravie\Spec\Contracts\Requirement;
use Laravie\Spec\Contracts\Result;

class Console implements Presenter
{
    /**
     * Output instance.
     *
     * @var \Illuminate\Console\OutputStyle
     */
    protected $output;

    /**
     * Construct a console presenter.
     */
    public function __construct(OutputStyle $output)
    {
        $this->output = $output;
    }

    /**
     * Handle the requirement.
     *
     * @return mixed
     */
    public function handle(Requirement $requirement)
    {
        $requirement->results()
            ->each(function (Result $result) {
                $this->title($result);

                Collection::make($result->errors())
                    ->each(function ($error) {
                        $this->error($error);
                    });

                Collection::make($result->recommendations())
                    ->each(function ($recommendation) {
                        $this->recommendation($recommendation);
                    });
            });
    }

    /**
     * Output the result title.
     *
     * @param  \Laravie\Spec\Contracts\Result  $result
     * @return void
     */
    protected function title(Result $result): void
    {
        $this->output->writeln($this->titleLineFrom(
            $result->failed() ? 'white' : 'black',
            $result->failed() ? 'red' : 'green',
            $result->name(),
            $result->description()
        ));
    }

    /**
     * Output the result error.
     *
     * @param  string  $error
     * @return void
     */
    protected function error(string $error): void
    {
        $this->output->writeln(
            $this->messageLineFrom('red', '✖', $error)
        );
    }

    /**
     * Output the result recommendation.
     *
     * @param  string  $recommendation
     * @return void
     */
    protected function recommendation(string $recommendation): void
    {
        $this->output->writeln(
            $this->messageLineFrom('yellow', '✎', $recommendation)
        );
    }

    /**
     * Returns the title contents.
     *
     * @copyright Nuno Maduro enunomaduro@gmail.com
     * @see https://github.com/nunomaduro/collision/blob/v5.0.0/src/Adapters/Phpunit/Style.php#L202-L211
     */
    private function titleLineFrom(string $fg, string $bg, string $title, string $description): string
    {
        return \sprintf(
            "\n  <fg=%s;bg=%s;options=bold> %s </><fg=default> %s</>", $fg, $bg, $title, $description
        );
    }

    /**
     * Returns the result recommendation.
     *
     * @copyright Nuno Maduro enunomaduro@gmail.com
     * @see https://github.com/nunomaduro/collision/blob/v5.0.0/src/Adapters/Phpunit/Style.php#L216-L232
     */
    private function messageLineFrom(string $fg, string $icon, string $description): string
    {
        return sprintf(
            "  <fg=%s;options=bold>%s</><fg=default> \e[2m%s\e[22m</>", $fg, $icon, $description
        );
    }
}
