# KissmetricsBundle

The KissmetricsBundle adds the ability to add all kissmetrics api calls
to your application. These include "identify", "record", "set", "alias".

There are additional Record objects premade for Page and Transaction.

## Installation

### Add this bundle to your project

Add the following lines in your deps file:

    [KissmetricsBundle]
        git=https://github.com/advancingu/KissmetricsBundle.git
        target=bundles/Tirna/KissmetricsBundle

### Application Kernel

Add KissmetricsBundle to the `registerBundles()` method of your application kernel:

    public function registerBundles()
    {
        return array(
            new Tirna\KissmetricsBundle\KissmetricsBundle(),
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
	or
    $this->container->get('kissmetrics.webtracker')->addRecord('Name', mixed $properties);
	or
    $this->container->get('kissmetrics.sessiontracker')->addRecord('Name');
	or
    $this->container->get('kissmetrics.sessiontracker')->addRecord('Name', mixed $properties);

Add Set
    $this->container->get('kissmetrics.webtracker')->addSet(mixed $properties);
	or
    $this->container->get('kissmetrics.sessiontracker')->addSet(mixed $properties);

Add Alias
    $this->container->get('kissmetrics.webtracker')->addAlias('Identify', 'Associate');
	or
    $this->container->get('kissmetrics.sessiontracker')->addAlias('Identify', 'Associate');

Add Transaction
    $transaction = new \Tirna\KissmetricsBundle\Record\Transaction();
    $transaction->setAffiliation('My Store');
    $transaction->setCity('New York');
    $transaction->setCountry('US');
    $transaction->setOrderNumber('xxxxx');
    $transaction->setShipping(10.46);
    $transaction->setState('NY');
    $transaction->setTax(5.35);
    $transaction->setTotal(100.00);
    
    $item = new \Tirna\KissmetricsBundle\Record\Transaction\Item();
    $item->setCategory('Technology');
    $item->setName('Keyboard');
    $item->setPrice(75.00);
    $item->setQuantity(3);
    $item->setSku('xx-yy');
    $transaction->addItem($item);

    $this->container->get('kissmetrics.webtracker')->addTransaction($transaction);
	or
    $this->container->get('kissmetrics.sessiontracker')->addTransaction($transaction);
