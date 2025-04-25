<?php
error_reporting(0);

    function filterDisplayValue($key, $value) {
        switch($key) {
            case '$python_version':
                // Convert 3.11.4 to 3.11
                $parts = explode('.', $value);
                return implode('.', array_slice($parts, 0, 2));
            case 'system':
                // Convert Darwin to macOS
                return $value === 'Darwin' ? 'macOS' : $value;
            case 'mods':
                // Remove telemetry from the list (all users)
                return str_replace('telemetry', '', $value);
            case 'workbench_enabled_list':  // fall through
            case 'workbench_disabled_list':  // fall through
            case 'workbench_default':
                // Remove the 'Workbench' suffix
                return str_replace('Workbench', '', $value);
            case 'navigation_style':
                return str_replace(['Gui::', 'NavigationStyle'], '', $value);
            default:
                return $value;
        }
    }

    function processTelemetryData() {
        $jsonFile = "posthog_events.json";
        if (!file_exists($jsonFile)) {
            return [];
        }

        $data = json_decode(file_get_contents($jsonFile), true);
        if (!$data) {
            return [];
        }

        $aggregated = [];
        $userMap = [];

        foreach ($data as $entry) {
            $id = $entry['distinct_id'];
            $props = $entry['properties'] ?? [];

            if (!isset($userMap[$id])) {
                $userMap[$id] = [];
            }

            // Handle version combination
            if (isset($props['version_major']) && isset($props['version_minor']) && isset($props['version_patch'])) {
                $version = $props['version_major'] . '.' . $props['version_minor'] . '.' . $props['version_patch'];
                if (!isset($userMap[$id]['version'])) {
                    $userMap[$id]['version'] = [];
                }
                $userMap[$id]['version'][$version] = true;
            }

            foreach ($props as $key => $val) {
                // Skip individual version components
                if ($key === 'version_major' || $key === 'version_minor' || $key === 'version_patch') {
                    continue;
                }

                if (is_array($val)) {
                    if (!isset($userMap[$id][$key])) {
                        $userMap[$id][$key] = [];
                    }
                    foreach ($val as $v) {
                        $userMap[$id][$key][$v] = true;
                    }
                } else {
                    $userMap[$id][$key] = $val;
                }
            }
        }

        // Aggregate the data
        foreach ($userMap as $props) {
            foreach ($props as $key => $value) {
                if (!isset($aggregated[$key])) {
                    $aggregated[$key] = [];
                }

                if (is_array($value)) {
                    foreach ($value as $v => $_) {
                        $filtered_v = filterDisplayValue($key, $v);
                        $aggregated[$key][$filtered_v] = ($aggregated[$key][$filtered_v] ?? 0) + 1;
                    }
                } else {
                    $filtered_value = filterDisplayValue($key, $value);
                    $aggregated[$key][$filtered_value] = ($aggregated[$key][$filtered_value] ?? 0) + 1;
                }
            }
        }

        return [
            'data' => $aggregated,
            'totalUsers' => count($userMap)
        ];
    }

    header('Content-Type: application/json');
    echo json_encode(processTelemetryData());
?>
