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

#### Optional (Add additional items to queue)
Add Identify
    $this->container->get('kissmetrics.webtracker')->addIdentify('Your Identity');
	or
    $this->container->get('kissmetrics.sessiontracker')->addIdentify('Your Identity');

Add Record
    $this->container->get('kissmetrics.webtracker')->addRecord('Name');
    $this->container->get('kissmetrics.webtracker')->addRecord('Name', mixed $properties);
    or 
    $this->container->get('kissmetrics.sessiontracker')->addRecord('Name');
    $this->container->get('kissmetrics.sessiontracker')->addRecord('Name', mixed $properties);

Add Set
    $this->container->get('kissmetrics.webtracker')->addSet(mixed $properties);
	or
    $this->container->get('kissmetrics.sessiontracker')->addSet(mixed $properties);

Add Alias
    $this->container->get('kissmetrics.webtracker')->addAlias('Identify', 'Associate');
	or
    $this->container->get('kissmetrics.sessiontracker')->addAlias('Identify', 'Associate');
