<?php

namespace App\Entities;

class Category
{
    private $name;
    private $creatd_at;
    private $updated_at;

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of creatd_at
     */
    public function getCreatd_at()
    {
        return $this->creatd_at;
    }

    /**
     * Set the value of creatd_at
     *
     * @return  self
     */
    public function setCreatd_at($creatd_at)
    {
        $this->creatd_at = $creatd_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
