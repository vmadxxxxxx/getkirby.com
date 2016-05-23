<since v="2.2.3">
## Max and min length

You can control the max and/or min length of the entered text by using the validate option. By adding the validators, a handy indicator of the current text length will be displayed in the upper right corner.

```
fields:
  name:
    label: Name
    type: text
    validate: 
      min: 10
      max: 1000
```
</since>