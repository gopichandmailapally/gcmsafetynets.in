---
description: Build deployment zip at fixed path
---

1. Ensure you are working inside the site root:
   - `/Volumes/Gopi/Latest Website/gcmsafetynets.in`

2. Run the deploy zip builder:
   - `bash make-deploy-zip.sh`

3. Upload this file to hosting:
   - `/Volumes/Gopi/Latest Website/gcmsafetynets-deploy.zip`

Notes:
- This overwrites the zip every time.
- Excludes common local/dev folders and runtime-generated folders (`logs/`, `cache/`, `uploads/`, `generated-pages/`).
  If you want any of those included in deploy, tell me and I’ll adjust the exclude list.
