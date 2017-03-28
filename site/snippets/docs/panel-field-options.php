### Dynamic options

Instead of defining options yourself, you can use an array of predefined dynamic ways to provide options:

#### Example

```
fields:
  category:
    label: Category
    type: <?= $field ?> 
    default: architecture
    options: children
```

#### Available option keywords

Option            | Description
----------------- | -------------
children          | List of options with all children
grandchildren     | List of options with all grandchildren
visibleChildren   | List of options with all visible children
invisibleChildren | List of options with all invisible children
visibleSiblings   | List of options with all visible siblings
invisibleSiblings | List of options with all invisible siblings
index             | List of options with all descendants
pages             | List of options with all pages of the site
siblings          | List of options with all siblings
files             | List of options with all files of the page
images            | List of options with all (link: docs/cheatsheet/file/type text: images) of the page
documents         | List of options with all (link: docs/cheatsheet/file/type text: documents) of the page
videos            | List of options with all (link: docs/cheatsheet/file/type text: videos) of the page
audio             | List of options with all (link: docs/cheatsheet/file/type text: audio files) of the page
code              | List of options with all (link: docs/cheatsheet/file/type text: code files) of the page
archives          | List of options with all (link: docs/cheatsheet/file/type text: archives) of the page


### Option queries

An even more powerful way of generating dynamic options is the query option:

#### Example

```
fields:
  category:
    label: Category
    type: <?= $field ?> 
    default: architecture
    options: query
    query:
      page: downloads
      fetch: files
      value: '{{filename}}'
      text: '{{filename}}'
      flip: true
```

#### Query Options

Option   | Default      | Description
-------- | ------------ | -----------
page     | current page | Any page URI. This is a powerful way to fetch any kind of data from any other page. You can even use relative paths to step up levels in the hierarchy. For example: ../../ to go two levels up or / to get to the top level.
fetch    | children     | See the list above for possible options
value    | {{uid}}      | A string to be used for the value attribute. You can use {{varname}} for any object method from the passed object (page or file)
text     | {{title}}    | A string to be used for the displayed option text. You can use {{varname}} for any object method from the passed object (page or file)
flip     | false        | If true, the list of options will be reversed
template | false        | A template name that will filter out all items with a different intended template


<since v="2.3.0">
### Option from other field

Dynamic options can also be generated from the content of another field (source field):

#### Example

```
fields:
  favorite_drink:
    label: Favorite Drink
    type: <?= $field ?> 
    options: field
    field:
      page: menu
      name: available_drinks
      separator: ;
```

This works best for [tags fields](tags) as source fields.

#### Source Field Options

Option    | Default      | Description
--------- | ------------ | -----------
page      | current page | Any page URI. This is a powerful way to fetch any kind of data from any other page. You can even use relative paths to step up levels in the hierarchy. For example: ../../ to go two levels up or / to get to the top level.
name      | tags         | Name of the source field
separator | ,            | Separator by which the source field will be split up into the options

</since>

### Dynamic options via JSON API

Sometimes you need more control to fetch information from external sources. You can achieve this by providing a valid URL to an API, which returns a JSON object with keys and values for the <?= $page->title()->lower() ?> field

#### Example

```
fields:
  category:
    label: Category
    type: <?= $field ?> 
    default: architecture
    options: http://example.com/api/categories.json
```

The json must have the following format:

```
{
  "design": "Design",
  "architecture": "Architecture",
  "photography": "Photography",
  "3d": "3D",
  "web": "Web"
}
```
