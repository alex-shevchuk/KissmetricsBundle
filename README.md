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

#### View
Default Web Tracker
    {% include "KissmetricsBundle:Tracker:web" with ['_view': _view] %}

OR Anonymous Session Tracker - Use this if you intend to alias the anonymous session user to a real user at some later point
    {% include "KissmetricsBundle:Tracker:session" with ['_view': _view] %}
