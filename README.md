# KissmetricsBundle

## Installation

### Application Kernel

Add KissmetricsBundle to the `registerBundles()` method of your application kernel:

    public function registerBundles()
    {
        return array(
            new Bundle\KissmetricsBundle\KissmetricsBundle(),
        );
    }

## Configuration

### Kissmetrics Tracker

#### Application config.yml
Enable loading of the Kissmetrics Tracker service by adding the following to the application's `config.yml` file:
- - -
    kissmetrics.tracker:
      config:
        apiKey: xxxxxx
