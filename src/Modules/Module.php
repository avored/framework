<?php

namespace AvoRed\Framework\Modules;

class Module
{
    /**
     * Module Identifier.
     */
    protected $identifier = null;
    /**
     * Module Name.
     */
    protected $name = null;
    /**
     * Module Description.
     */
    protected $description = null;
    /**
     * Module Status.
     */
    protected $status = null;
    /**
     * Module NameSpace.
     */
    protected $namespace = null;
    /**
     * Module BasePath.
     */
    protected $basePath = null;
    /**
     * Module Published Tabs.
     */
    protected $publishedTags = null;

    /**
     * Module dependencies
     */
    protected $dependencies = [];

    /**
     * Get/Set the Identifier for the Module
     * @param string $identifier
     * @return string|self
     */
    public function identifier($identifier = null)
    {
        if (null === $identifier) {
            return $this->identifier;
        }

        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get/Set the Name for the Module.
     * @param string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if (null === $name) {
            return $this->name;
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Get/Set the Description for the Module.
     * @param string $description
     * @return string|self
     */
    public function description($description = null)
    {
        if (null === $description) {
            return $this->description;
        }

        $this->description = $description;

        return $this;
    }

    /**
     * Get/Set the Status for the Module.
     * @param string $identifier
     * @return string|self
     */
    public function status($status = null)
    {
        if (null === $status) {
            return $this->status;
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get/Set the NameSpace for the Module.
     * @param string $namespace
     * @return string|self
     */
    public function namespace($namespace = null)
    {
        if (null === $namespace) {
            return $this->namespace;
        }

        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Get/Set the BasePath for the Module.
     * @param string $basePath
     * @return string|self
     */
    public function basePath($basePath = null)
    {
        if (null === $basePath) {
            return $this->basePath;
        }

        $this->basePath = $basePath;

        return $this;
    }

    /**
     * Get/Set the Published Tags for the Module.
     * @param array $publishedTags
     * @return string|self
     */
    public function publishedTags($publishedTags = [])
    {
        if (count($publishedTags) <= 0) {
            return $this->publishedTags;
        }

        $this->publishedTags = $publishedTags;

        return $this;
    }

    /**
     * Get/Set the Dependencies for the Module
     * @param array $dependencies
     * @return string|self
     */
    public function dependencies($dependencies = [])
    {
        if (count($dependencies) <= 0) {
            return $this->dependencies;
        }

        $this->dependencies = $dependencies;
        return $this;
    }

    /**
     * To check If method Exist then it will execute other wise do nothing
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        }
    }
}
