<div class="form-group">
    <label for="name">Name</label>
    <input type="text"
        name="name"
        value="{{ $page->getName() }}"
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
        value="{{ $page->getSlug() }}"
        class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}"
        id="slug" />
        @if ($errors->has('slug'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('slug') }}</strong>
        </span>
    @endif
</div>

<markdown-editor name="content" value="{{ $page->getContent() }}" ref="markdownEditor"></markdown-editor>

<div class="form-group">
    <label for="meta_title">Meta Title</label>
    <input type="text"
        name="meta_title"
        value="{{ $page->getMetaTitle() }}"
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
         value="{{ $page->getMetaDescription() }}"
        class="form-control {{ $errors->has('meta_description') ? ' is-invalid' : '' }}"
        id="meta_description" />
        @if ($errors->has('meta_description'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('meta_description') }}</strong>
        </span>
    @endif
</div>
