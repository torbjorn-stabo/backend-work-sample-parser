<?php
$cfg = [];

/**
 * General purpose function for accessing nodes in cfg tree
 * 
 * @param string $path
 * @param array $cfg_root
 * @return mixed
 */
function &getCfgItemByDotPath($path, &$cfg_root) {
    $current = &$cfg_root;
    foreach(explode('.', $path) as $item) {
        $current[$item] = $current[$item] ?? [];
        $current = &$current[$item];
    }
    
    return $current;
}

/**
 * Convert config.txt data to the correct type
 * 
 * @param string $data
 * @throws ErrorException
 * @return string|boolean|number
 */
function parseCfgDataString(string $data) {
    // String
    if ($data[0]==='"') {
        if ($data[strlen($data) - 1] !== '"') {
            throw new ErrorException("Unterminated string");
        }
        
        return substr($data, 1, -1);
    }
    
    // Boolean
    if (in_array(strtolower($data), ['true', 'false'])) {
        return strtolower($data) === 'true';
    }
    
    // Number
    if (is_numeric($data)) {
        return $data + 0;
    }
    
    return $data;
}

$raw_lines = file('/tmp/config.txt');

$raw_lines = array_map('trim', $raw_lines); // Trailing/leading whitespace
$raw_lines = array_filter($raw_lines, 'strlen'); // Empty lines
$raw_lines = array_filter($raw_lines, fn($item) => $item[0]!=='#'); // Comment lines

foreach($raw_lines as $line) {
    [$path, $data] = preg_split('/\s*=\s*/', $line, 2);
    
    $cfg_item = &getCfgItemByDotPath($path, $cfg);
    $cfg_item = parseCfgDataString($data);
}
unset($cfg_item);

var_dump($cfg);
