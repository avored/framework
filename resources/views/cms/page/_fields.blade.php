<div class="form-group">
    <label for="name">Name</label>
    <input type="text"
        name="name"
        @if(!$isDefaultLang && !in_array('name', $page->getTranslatedAttributes()))
            disabled
        @endif
        value="{{ (isset($page)) ? $page->getName() : '' }}"
        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
        id="name" />
        @if ($errors->has('name'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text"
        name="slug"
        value="{{ (isset($page)) ? $page->getSlug() : '' }}"
        class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}"
        id="slug" />
        @if ($errors->has('slug'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('slug') }}</strong>
        </span>
    @endif
</div>

<markdown-editor 
    name="content"
    value="{{ (isset($page)) ?  $page->getContent() : '' }}"
    ref="markdownEditor"></markdown-editor>

<div class="form-group">
    <label for="meta_title">Meta Title</label>
    <input type="text"
        name="meta_title"
        value="{{ (isset($page)) ? $page->getMetaTitle() : '' }}"
        class="form-control {{ $errors->has('meta_title') ? ' is-invalid' : '' }}"
        id="meta_title" />
        @if ($errors->has('meta_title'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('meta_title') }}</strong>
        </span>
    @endif
</div>


<div class="form-group">
    <label for="meta_description">Meta Description</label>
    <input type="text"
        name="meta_description"
         value="{{ isset($page)) ? $page->getMetaDescription() : '' }}"
        class="form-control {{ $errors->has('meta_description') ? ' is-invalid' : '' }}"
        id="meta_description" />
        @if ($errors->has('meta_description'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('meta_description') }}</strong>
        </span>
    @endif
</div>
