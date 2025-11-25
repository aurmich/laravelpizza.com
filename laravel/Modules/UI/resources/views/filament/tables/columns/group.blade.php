<?php

declare(strict_types=1);

?>
@php
    $fields=$getFields();
    $record=$getRecord();
@endphp
<div
    {{
        $attributes
            ->merge($getExtraAttributes(), escape: false)
            ->class([
                'fi-ta-icon flex flex-wrap gap-1.5',
                'px-3 py-4' => ! $isInline(),
                //'flex-col' => $isListWithLineBreaks(),
                'flex-col' => true,
            ])
    }}
>
    @foreach ($fields as $field)
     
        @php
            $name = $field->getName();
            $value = $record->getAttribute($name);
            
            // Skip empty values to save space
            if (empty($value) && $value !== 0 && $value !== '0') {
                continue;
            }
            
            // Format the value for display
            $formattedValue = $value;
            
            // Add label if the field has one (for better readability)
            $label = $field->getLabel() ?? $name;
            $displayText = $label . ': ' . $formattedValue;
        @endphp
        
            {!! $displayText !!}<br/>
        
        
    @endforeach
</div>
