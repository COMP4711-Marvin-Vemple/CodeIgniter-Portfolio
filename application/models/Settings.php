<?php

/**
 * This is a model for "Settings". It provides access to settings stored
 * in a database as name=>value pairs.
 * 
 * @author Calvin Rempel
 */
class Settings extends CI_Model {
    private $data;
    
    /**
     * Construct the base CI_Model
     */
    public function __construct() {
        parent::__construct();
        $result = (array) $this->db->get('settings')->result();
        
        // Store settings with name as key
        foreach ($result as $setting) {
            $this->data[$setting->name] = $setting->value;
        }
    }
    
    /**
     * Get the Value of a Setting
     * 
     * @param string $name the name of the settings whose value to retreive
     * @return string data (empty string if doesn't exist)
     */
    public function getValue($name) {
        if (isset($this->data[$name]))
            return $this->data[$name];
        
        return '';
    }
    
    /**
     * Set the value of a named setting. If the setting already exists in the table, it
     * will be updated. If it doesn't, it will be created.
     * 
     * @param string $name the name of the setting
     * @param string $value the new value of the setting
     */
    public function setValue($name, $value) {
        // Create the data to be set
        $newData = array(
            'name'  => $name,
            'value' => $value
        );
        
        // Insert or Update depending on if the setting exists or not already
        if (isset($this->data[$name])) {
            $this->db->where('name', $name);
            $this->db->update('settings', $newData);
        }
        else {
            $this->db->insert('settings', $newData);
        }
        
        // Update cached copy in memory
        $this->data[$name] = $value;
    }
}