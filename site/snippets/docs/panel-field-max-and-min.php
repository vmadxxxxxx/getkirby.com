<since v="2.2.3">
## Max and min length

You can control the max and/or min length of the entered text by using the validate option. By adding the validators, a handy indicator of the current text length will be displayed in the upper right corner.

```
fields:
  name:
    label: Name
    type: text
    validate: 
      minLength: 10
      maxLength: 1000
```
</since>

<since v="2.3.2">
### Names of validators
Please note that the names of the validators have been changed from `min` to `minLength` and from `max` to `maxLength` respectively.
Before 2.3.2, the `min` and `max` validators would check for the value of the number if a numeric value is entered. You can still use those if that's the intended behavior.
</since>
