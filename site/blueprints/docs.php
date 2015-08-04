<?php if(!defined('KIRBY')) exit ?>

title: Docs
pages: docs
files: true
fields:
  title:
    label: Title
    type:  text
  description:
    label: Description
    type:  text
    icon:  info-circle
  text:
    label: Text
    type:  textarea
    icon:  file-text-o
  line-a:
    type:  line
  docs:
    label: Docs
    type: structure
    fields:
      text:
        label: Title
        type:  text
      link:
        label: Link
        type:  text
        icon:  link
  blogposts:
    label: Blogposts
    type: structure
    fields:
      text:
        label: Title
        type:  text
      link:
        label: Link
        type:  text
        icon:  link
  forumposts:
    label: Forumposts
    type: structure
    fields:
      text:
        label: Title
        type:  text
      link:
        label: Link
        type:  text
        icon:  link
  internals:
    label: Internals
    type: structure
    fields:
      text:
        label: Title
        type:  text
      link:
        label: Link
        type:  text
        icon:  link
  externals:
    label: Externals
    type: structure
    fields:
      text:
        label: Title
        type:  text
      link:
        label: Link
        type:  text
        icon:  link
