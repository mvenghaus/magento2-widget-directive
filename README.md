# Magento 2 - Widget Directive

Simple parser & builder for Magento 2 widget directives outside of the Magento environment.

## Installation

Install the package via composer:

```bash
composer require mvenghaus/magento2-widget-directive:"^1.0"
```

# Usage

## Parse directives from a string

```php
$content = <<<EOF
Lorem ipsum dolor sit amet, consetetur sadipscing elitr.

{{widget type="TestWidget\Widget" param1="foo" param2="bar"}}

Lorem ipsum dolor sit amet, consetetur sadipscing elitr.
EOF;


$widgetParser = new \Mvenghaus\Magento2WidgetDirective\WidgetParser();
$widgets = $widgetParser->parse($content);

/** @var \Mvenghaus\Magento2WidgetDirective\Data\WidgetData $widget */
foreach ($widgets as $widget) {
    echo $widget->type;
    print_r($widget->properties);
}
```

## Building a directive

```php
$widgetBuilder = new \Mvenghaus\Magento2WidgetDirective\WidgetBuilder();

$result = $widgetBuilder->build(
    new WidgetData(
       type: '\\TestWidget\\Widget',
       properties: [
           'param1' => 'foo',
           'param2' => 'bar'
        ]
    )
);

// -> {{widget type="TestWidget\Widget" param1="foo" param2="bar"}}
```

## Run Tests

```bash
composer test
```